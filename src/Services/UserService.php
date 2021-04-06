<?php


namespace App\Services;


use App\Entity\User;
use App\Models\Forms\UserEditForm;
use App\Models\Forms\UserEditRoleForm;
use App\Models\Forms\UserNewForm;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    /**
     * @var EntityManagerInterface $manager
     */
    private $manager;
    /**
     * @var UserPasswordEncoderInterface $passwordEncoder
     */
    private $passwordEncoder;

    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    public function __construct(EntityManagerInterface $manager,
                                UserPasswordEncoderInterface $passwordEncoder,
                                UserRepository $userRepository)
    {
        $this->manager = $manager;
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
    }

    public function newUser(UserNewForm $userNewForm)
    {
        $user = new User();
        $user
            ->setName($userNewForm->getName())
            ->setPrenom($userNewForm->getPrenom())
            ->setEmail($userNewForm->getEmail())
            ->setPassword($this->passwordEncoder->encodePassword($user,$userNewForm->getPassword()));

        try {
            $this->manager->persist($user);
            $this->manager->flush();
            return $user;
        }
        catch (\PDOException $exception)
        {
            throw new Exception('Unexpected Error',500);
        }
    }

    /**
     * @param UserEditRoleForm $userEditRoleForm
     * @param $user_id
     * @return array
     */
    public function userEditRole(UserEditRoleForm $userEditRoleForm, $user_id)
    {
        $arrayUser =  [];
        $user = $this->userRepository->findOneBy(['id'=>$user_id]);
        $user
            ->setRoles([$userEditRoleForm->getRole()]);

        try{
           $this->manager->flush();
            $arrayUser[] = $user;
            return $arrayUser;
        }
        catch (\PDOException $exception)
        {
            throw new Exception('Unexpected Error',500);
        }
    }

    /**
     * @param UserEditForm $userEditForm
     * @param $username
     * @return User[]
     */
    public function editUserProfil(UserEditForm $userEditForm,$username)
    {
        $user = $this->userRepository->findOneBy(['email'=>$username]);
        $user
            ->setEmail($userEditForm->getEmail())
            ->setName($userEditForm->getName())
            ->setPrenom($userEditForm->getPrenom())
            ->setPassword($this->passwordEncoder->encodePassword($user,$userEditForm->getPassword()));

        try {
            $this->manager->flush();
            $usernameNotChangeEmail = $this->getUserProfil($username);
            if($usernameNotChangeEmail)
            {
                return $usernameNotChangeEmail;
            }
            else
            {
                return $this->getUserProfil($userEditForm->getEmail());
            }
        }
        catch (Exception $exception)
        {
            throw new Exception('Unexpected Error',500);
        }
    }
    /**
     * @return User[]
     */
    public function userList()
    {
        return $this->userRepository->findBy(["is_active"=>true]);
    }

    /**
     * @param $userId
     * @return User[]
     */
    public function getUser($userId)
    {
        return $this->userRepository->findBy(['id' => $userId]);
    }

    /**
     * @param $username
     * @return User[]
     */
    public function getUserProfil($username)
    {
        return $this->userRepository->findBy(['email'=>$username]);
    }
    /**
     *
     * @param $userId
     * @return User[]
     */
    public function userDelete($userId)
    {
        $user = $this->userRepository->find($userId);
        if($user)
        {
            $user->setIsActive(false);
            try {
                $this->manager->flush();
                return $this->userList();
            }
            catch (\PDOException $exception)
            {
                throw new Exception('Unexpected Error',500);
            }

        }
        else
        {
            throw new Exception('User not found',404);
        }
    }
}