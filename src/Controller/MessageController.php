<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
//use Symfony\Component\Validator\Constraints as Assert;
//$message->getDate()->format('Y-m-d')
class MessageController extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    #[Route('/message', name: 'create_message')]
    public function createMessage(Request $request,EntityManagerInterface $entityManager): Response
    {
        
        // creates a task object and initializes some data for this example
        $message = new Message();
        $message->setFecha($message->getDate()->format('Y-m-d'));
        $msg = $entityManager->getRepository(Message::class);
        $msgs = $msg->findAll();
        if(!$msgs)
        {
            $message->setNombre('santiago');
            $message->setApellido('ladino');
            $message->setCorreo('aaa@hotmail.com');
            $message->setCelular('12345');
            $message->setArea_contacto('IRIDAN');
            $message->setMensaje('hola');
            $message->setFecha($message->getDate()->format('Y-m-d'));
            $entityManager->persist($message);
            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
            $this->logger->info('Saved new message with id '.$message->getId());
        }

        $form = $this->createFormBuilder($message)
            ->add('nombre', TextType::class)
            ->add('apellido', TextType::class)
            ->add('correo', TextType::class)
            ->add('celular', TextType::class)
            ->add('area_contacto', TextType::class)
            ->add('mensaje', TextType::class)  
            ->add('save', SubmitType::class, ['label' => 'Create Message'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $correo = $data->getCorreo();
            $existeCorreo = $entityManager->getRepository(Message::class)->findOneBy(['correo' => $correo]);
            $f = $message->getFecha();
            if ($existeCorreo) {
                $this->logger->info('XXXXXXXXXXXXXXXXXXXXXXXXX'.substr($existeCorreo->getFecha(),5,2));
                $mes = intval(substr($existeCorreo->getFecha(),5,2));
                $dia = intval(substr($existeCorreo->getFecha(),8,2));
                if(intval(substr($f,5,2)) > $mes || intval(substr($f,8,2)) > $dia) {
                    $message->setFecha($message->getDate()->format('Y-m-d'));
                    $entityManager->persist($message);
                    $entityManager->flush();
                    return $this->redirectToRoute('validate');
                }else {
                    echo "Solo se pede enviar un mensaje por dia";
                }
            }else{
                $message->setFecha($message->getDate()->format('Y-m-d'));
                $entityManager->persist($message);
                $entityManager->flush();
                return $this->redirectToRoute('validate');
            }
            //return $this->redirectToRoute('validate');
        }

        return $this->render('message.html.twig', [
            'form' => $form,
        ]);

    }

    #[Route('/validate', name: 'validate')]
    public function validate(Request $request,EntityManagerInterface $entityManager): Response
    {
        return $this->render('validate.html.twig');
    }

}