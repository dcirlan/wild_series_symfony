<?php
// src/Controller/CategoryController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/categories", name="category_")
 */

Class CategoryController extends AbstractController
{
    /**
    * Show all rows from Category's entity
    *
    * @Route("/", name="index")
    * @return Response A response instance
    */

    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render(
            'category/index.html.twig',
            ['categories' => $categories]
        );
    }

        /**
         * The controller for the category add form
         * @Route("/new", name="new")
         * @IsGranted("ROLE_ADMIN")
         */
        public function new(Request $request) : Response
        {
            // Create a new Category Object
            $category = new Category();

            // Create the associated Form
            $form = $this->createForm(CategoryType::class, $category);

            // Get data from HTTP request
            $form->handleRequest($request);

            // Was the form submitted ?
            if ($form->isSubmitted() && $form->isValid()) {
                // Deal with the submitted data

                // Get the Entity Manager
                $entityManager = $this->getDoctrine()->getManager();

                // Persist Category Object
                $entityManager->persist($category);

                // Flush the persisted object
                $entityManager->flush();

                // Once the form is submitted, valid and the data inserted in database, you can define the success flash message
                $this->addFlash('success', 'Nouvelle catégorie ajoutée');

                // Finally redirect to categories list
                return $this->redirectToRoute('category_index');
            }

            // Render the form
            return $this->render('category/new.html.twig', ["form" => $form->createView()]);
        }

        // L'action show() se trouvera plus bas

    /**
     * @Route("/{categoryName}", name = "show")
     * @return response
     */
    public function show(string $categoryName): Response
    {
        $category = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findOneBy(['name' => $categoryName]);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category with id : '.$categoryName.' found in category\'s table.'
            );
        }
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['category' => $category->getId()], ['id' => 'DESC'], 3);


        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs,
        ]);

    }
 }
