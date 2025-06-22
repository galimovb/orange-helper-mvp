<?php

namespace App\Service;

use App\Entity\PasswordResetOTP;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;

class OtpService
{
    public function __construct(
        private EntityManagerInterface $em,
        private TexterInterface $texter,
    ) {}

    public function generateAndSendOtp(string $phone): void
    {
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT); // 6-значный код
        $otp = new PasswordResetOTP($phone, $code);

        $this->em->persist($otp);
        $this->em->flush();

        // Отправка SMS через Symfony Notifier
        $sms = new SmsMessage(
            $phone,
            "Ваш код для сброса пароля: {$code}"
        );
        $this->texter->send($sms);
    }

    public function validateOtp(string $phone, string $code): bool
    {
        $otp = $this->em->getRepository(PasswordResetOTP::class)->findOneBy([
            'phone' => $phone,
            'code' => $code,
        ]);

        if (!$otp || $otp->getExpiresAt() < new \DateTime()) {
            return false;
        }

        $this->em->remove($otp); // Удаляем использованный код
        $this->em->flush();

        return true;
    }
}