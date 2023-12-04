<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;
    #[ORM\Column(length: 255)]
    public string $nombre;
    #[ORM\Column(length: 255)]
    public string $apellido;
    #[ORM\Column(length: 255)]
    public string $correo;
    #[ORM\Column(length: 255)]
    public string $celular;
    #[ORM\Column(length: 255)]
    public string $area_contacto;
    #[ORM\Column(length: 255)]
    public string $mensaje;
    /**
     * @ORM\Column(type="datetime")
     * @Assert\Callback({"App\Entity\Message", "validarFecha"})
     */
    public \DateTimeInterface $date;

    #[ORM\Column(length: 255)]
    public string $fecha;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function getId():int
    {
        return $this->id;
    }

    public function getNombre():string
    {
        return $this->nombre;
    }

    public function getApellido():string
    {
        return $this->apellido;
    }

    public function getCorreo():string
    {
        return $this->correo;
    }

    public function getCelular():string
    {
        return $this->celular;
    }

    public function getArea():string
    {
        return $this->area_contacto;
    }

    public function getMensaje():string
    {
        return $this->mensaje;
    }

    public function getDate():\DateTimeInterface
    {
        return $this->date;
    }
    
    public function getFecha():string
    {
        return $this->fecha;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre= $nombre;
    }

    public function setApellido(string $apellido): void
    {
        $this->apellido= $apellido;
    }

    public function setCorreo(string $correo): void
    {
        $this->correo= $correo;
    }

    public function setCelular(string $celular): void
    {
        $this->celular= $celular;
    }

    public function setArea_contacto(string $area_contacto): void
    {
        $this->area_contacto= $area_contacto;
    }

    public function setMensaje(string $mensaje): void
    {
        $this->mensaje= $mensaje;
    }

    public function setDate(?\DateTimeInterface $date): void
    {
        $this->date= $date;
    }

    public function setFecha(string $fecha): void
    {
        $this->fecha= $fecha;
    }
}