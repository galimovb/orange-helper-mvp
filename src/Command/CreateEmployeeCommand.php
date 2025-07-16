<?php

namespace App\Command;

use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-employee',
    description: 'Создает нового сотрудника или администратора',
)]
class CreateEmployeeCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('phone', InputArgument::REQUIRED, 'Телефон (пример: +79991234567)')
            ->addArgument('password', InputArgument::REQUIRED, 'Пароль')
            ->addOption('admin', null, InputOption::VALUE_NONE, 'Добавить как администратора (ROLE_ADMIN)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $phone = $input->getArgument('phone');
        $password = $input->getArgument('password');
        $isAdmin = $input->getOption('admin');

        $normalizedPhone = preg_replace('/[^\d+]/', '', $phone);
        if (str_starts_with($normalizedPhone, '89')) {
            $normalizedPhone = '+7' . substr($normalizedPhone, 1);
        }
        if (!str_starts_with($normalizedPhone, '+')) {
            $normalizedPhone = '+' . $normalizedPhone;
        }

        // Проверка на существующего пользователя
        $repo = $this->em->getRepository(Employee::class);
        if ($repo->findOneBy(['phoneNumber' => $normalizedPhone])) {
            $output->writeln('<error>Пользователь с таким телефоном уже существует.</error>');
            return Command::FAILURE;
        }

        $employee = new Employee();
        $employee->setPhoneNumber($normalizedPhone);
        $employee->setPassword($this->passwordHasher->hashPassword($employee, $password));
        $employee->setRoles([$isAdmin ? 'ROLE_ADMIN' : 'ROLE_EMPLOYEE']);
        $employee->setFirstName('Имя');
        $employee->setLastName('Фамилия');
        $employee->setSecondName('Отчество');
        $employee->setAge(30);

        $this->em->persist($employee);
        $this->em->flush();

        $output->writeln('<info>Пользователь успешно создан: ' . $normalizedPhone . '</info>');
        return Command::SUCCESS;
    }
}
