<?php
namespace Example\AddressBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

/**
 * @ORM\Entity
 * @ORM\Table(name="people")
 */
class People
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $firstName;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $lastName;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $addressLine1;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $addressLine2;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $city;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $postcode;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $telephoneHome;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $telephoneMobile;   
    

    /**
     * Validation Constraints
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata){
    
        // Check required fields
        $metadata->addPropertyConstraint('firstName', new NotBlank());
        $metadata->addPropertyConstraint('lastName', new NotBlank());
        $metadata->addPropertyConstraint('addressLine1', new NotBlank());
        $metadata->addPropertyConstraint('addressLine2', new NotBlank());
        $metadata->addPropertyConstraint('city', new NotBlank());
        $metadata->addPropertyConstraint('postcode', new NotBlank());
        $metadata->addPropertyConstraint('telephoneHome', new NotBlank());
        $metadata->addPropertyConstraint('telephoneMobile', new NotBlank());
        
        
        // String Validation
//         $metadata->addPropertyConstraint('email', new Assert\Email(array(
//                 'message' => 'The email "{{ value }}" is not a valid email'
//         )));
    
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return People
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return People
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set addressLine1
     *
     * @param string $addressLine1
     * @return People
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;
    
        return $this;
    }

    /**
     * Get addressLine1
     *
     * @return string 
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * Set addressLine2
     *
     * @param string $addressLine2
     * @return People
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;
    
        return $this;
    }

    /**
     * Get addressLine2
     *
     * @return string 
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return People
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return People
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    
        return $this;
    }

    /**
     * Get postcode
     *
     * @return string 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set telephoneHome
     *
     * @param string $telephoneHome
     * @return People
     */
    public function setTelephoneHome($telephoneHome)
    {
        $this->telephoneHome = $telephoneHome;
    
        return $this;
    }

    /**
     * Get telephoneHome
     *
     * @return string 
     */
    public function getTelephoneHome()
    {
        return $this->telephoneHome;
    }

    /**
     * Set telephoneMobile
     *
     * @param string $telephoneMobile
     * @return People
     */
    public function setTelephoneMobile($telephoneMobile)
    {
        $this->telephoneMobile = $telephoneMobile;
    
        return $this;
    }

    /**
     * Get telephoneMobile
     *
     * @return string 
     */
    public function getTelephoneMobile()
    {
        return $this->telephoneMobile;
    }
}