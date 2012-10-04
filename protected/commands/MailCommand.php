<?php

class MailCommand extends CConsoleCommand {

    public $params = array();

    public function actionSend($user_id, $template) {
        $user = Users::model()->findByPk($user_id);
        if(!$user || !$user->email){
            throw new Exception(404, Yii::t('Console', 'User not found or empty email'));
        }
        $mailer = Yii::app()->mailer;
        if($mailer->Host){
            $mailer->IsSMTP();
        } else {
            $mailer->IsMail();
        }
        $mailer->AddAddress($user->email);
        $mailer->FromName = 'Social.Migom.By';
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = Yii::t('Mail', 'Social.Migom.By');
        $mailer->getView($template, array('user'=>$user, 'params' => $this->params));
        $mailer->Send();
    }

    public function run($args) {
        list($action, $options, $args) = $this->resolveRequest($args);
        $methodName = 'action' . $action;
        if (!preg_match('/^\w+$/', $action) || !method_exists($this, $methodName))
            $this->usageError("Unknown action: " . $action);

        $method = new ReflectionMethod($this, $methodName);
        $params = array();
        // named and unnamed options
        foreach ($method->getParameters() as $i => $param) {
            $name = $param->getName();
            if (isset($options[$name])) {
                if ($param->isArray())
                    $params[] = is_array($options[$name]) ? $options[$name] : array($options[$name]);
                else if (!is_array($options[$name]))
                    $params[] = $options[$name];
                else
                    $this->usageError("Option --$name requires a scalar. Array is given.");
            }
            else if ($name === 'args')
                $params[] = $args;
            else if ($param->isDefaultValueAvailable())
                $params[] = $param->getDefaultValue();
            else
                $this->usageError("Missing required option --$name.");
            unset($options[$name]);
        }

        // set options to params
        if (!empty($options)) {
            foreach ($options as $name => $value) {
                $this->params[$name] = $value;
                unset($options[$name]);
            }
        }

        if (!empty($options))
            $this->usageError("Unknown options: " . implode(', ', array_keys($options)));

        $exitCode = 0;
        if ($this->beforeAction($action, $params)) {
            $exitCode = $method->invokeArgs($this, $params);
            $exitCode = $this->afterAction($action, $params, is_int($exitCode) ? $exitCode : 0);
        }
        return $exitCode;
    }

}