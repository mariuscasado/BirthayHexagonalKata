<?php

declare(strict_types=1);


namespace App;


use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class BirthdayService
{
    private EmployeeRepository $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function sendGreetings(
        OurDate $ourDate,
        string $smtpHost,
        int $smtpPort
    ): void {
        $employees = $this->repository->getEmployees();

        foreach($employees as $employee) {
            if ($employee->isBirthday($ourDate)) {
                $recipient = $employee->getEmail();
                $body = sprintf('Happy Birthday, dear %s!', $employee->getFirstName());
                $subject = 'Happy Birthday!';
                $this->sendMessage($smtpHost, $smtpPort, 'sender@here.com', $subject, $body, $recipient);
            }
        }
    }

    protected function sendMessage(
        string $smtpHost,
        int $smtpPort,
        string $sender,
        string $subject,
        string $body,
        string $recipient
    ): void {
        $mailer = new Swift_Mailer(
            new Swift_SmtpTransport($smtpHost, $smtpPort)
        );
        $msg = new Swift_Message($subject);
        $msg->setFrom($sender)
            ->setTo([$recipient])
            ->setBody($body);


        $this->send($msg, $mailer);
    }

    protected function send(Swift_Message $msg, Swift_Mailer $mailer)
    {
        $mailer->send($msg);
    }
}