<?php

namespace SONBase\Mail;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\View\Model\ViewModel;

/**
 * Class Mail
 * @package SONBase\Mail
 */
class Mail
{
    /**
     * @var SmtpTransport
     */
    protected $transport;

    /**
     * @var
     */
    protected $view;

    /**
     * @var MimeMessage
     */
    protected $body;

    /**
     * @varm Message
     */
    protected $message;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $to;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $page;

    /**
     * @param SmtpTransport $transport
     * @param $view
     * @param $page
     */
    public function __construct(SmtpTransport $transport, $view, $page)
    {
        $this->transport = $transport;
        $this->view = $view;
        $this->page = $page;
    }

    /**
     * @param $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param $to
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return $this
     */
    public function prepare()
    {
        $html = new MimePart($this->renderView($this->page, $this->data));
        $html->type = 'text/html';

        $body = new MimeMessage();
        $body->setParts([$html]);
        $this->body = $body;

        $config = $this->transport->getOptions()->toArray();

        $this->message = new Message();
        $this->message->addFrom($config['connection_config']['from'])
            ->addTo($this->to)
            ->setSubject($this->subject)
            ->setBody($this->body);

        return $this;
    }

    /**
     * Sends the message
     */
    public function send()
    {
        $this->transport->send($this->message);
    }

    /**
     * @param $page
     * @param array $data
     * @return mixed
     */
    protected function renderView($page, array $data)
    {
        $model = new ViewModel();
        $model->setTemplate("mailer/{$page}.phtml");
        $model->setOption('has_parent', true);
        $model->setVariables($data);

        return $this->view->render($model);
    }
}
