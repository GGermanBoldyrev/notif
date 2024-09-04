<?php

namespace services;

use PHPMailer\PHPMailer\PHPMailer;

class EmailService
{
    private PHPMailer $mailer;
    private array $config;

    public function __construct(array $config)
    {
        $this->mailer = new PHPMailer(true);
        $this->config = $config;
        $this->setup();
    }

    private function setup(): void
    {
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $this->config['mail']['mail_box_name'];
        $this->mailer->Password = $this->config['mail']['password'];
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587;
        $this->mailer->CharSet = 'UTF-8';
    }

    public function sendEmail($to, $subject, $body): bool
    {
        try {
            $this->mailer->setFrom($this->config['mail']['mail_box_name'], $this->config['mail']['username']);
            $this->mailer->addAddress($to);

            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
            $this->mailer->AltBody = strip_tags($body);

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}