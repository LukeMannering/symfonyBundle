<?php
namespace Example\AddressBookBundle\Controller;

use Example\AddressBookBundle\Entity\People;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PeopleController extends Controller
{
    /**
     * Shows the list of all address book entries
     */
    public function listAction(){
        return $this->render('ExampleAddressBookBundle:People:index.html.twig', array('name' => ''));
    }

    /**
     * Produce form, and handle form submission
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request){
        
        $person = new People();
         
        $form = $this->createFormBuilder($person)
            ->add('firstName', 'text', array(
                'required' => true,
                'max_length'=> 100
            ))
            ->add('lastName', 'text', array(
                'required' => false,
                'max_length'=> 100
            ))
            ->add('addressLine1', 'text', array(
                'required' => false,
                'max_length'=> 100
            ))
            ->add('addressLine2', 'text', array(
                'required' => false,
                'max_length'=> 100
            ))
            ->add('city', 'text', array(
                'required' => false,
                'max_length'=> 100
            ))
            ->add('postcode', 'text', array(
                'required' => false,
                'max_length'=> 100
            ))
            ->add('telephoneHome', 'text', array(
                'required' => false,
                'max_length'=> 100
            ))
            ->add('telephoneMobile', 'text', array(
                'required' => false,
                'max_length'=> 100
            ))
            ->getForm();
    
        // Check if Form was submitted
        if ($request->getMethod() == 'POST'){
            
            $form->bind($request);
    
            if ($form->isValid()){
                
                // Persist to DB using Doctrine                
                $em = $this->getDoctrine()->getManager();
                $em->persist($person);
                $em->flush();
    
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Your changes were saved!'
                );
                //return $this->redirect($this->generateUrl('users_register_success'));
            }
        }
    
        // Insert a form view into the template
        return $this->render('ExampleAddressBookBundle:People:form.html.twig', array (
            'form'=> $form->createView(),
        ));
    }
    
}