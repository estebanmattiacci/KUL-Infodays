<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Entity\Infoday;
use App\Entity\Interest;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class OverviewController extends AbstractController
{
    #[Route('/overview/feedbacks', name: 'app_feedbacks')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED");

        /** @var User $user */
        $user = $this->getUser();
        if($user) {
            if (!$user->isVerified()) {
                return $this->render('admin/please_verify.html.twig');
            }
        }

        $feedbackRepo= $entityManager->getRepository(Feedback::class);
        $feedbacks = $feedbackRepo->findAll();
        return $this->render('overview/index.html.twig', [
            'feedbacks' => $feedbacks,
        ]);
    }
    #[Route('/overview/statistics', name: 'app_statistics')]
    public function charts(EntityManagerInterface $entityManager, ChartBuilderInterface $chartBuilder): Response
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED");
        /** @var User $user */
        $user = $this->getUser();
        if($user) {
            if (!$user->isVerified()) {
                return $this->render('admin/please_verify.html.twig');
            }
        }
        $infodays = $entityManager->getRepository(Infoday::class)->findAll();
        $labels = [];
        $data = [];
        foreach( $infodays as $infoday){
            $labels[] = (string) $infoday;
            $data[] = count($infoday->getUsers());
        }
        $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
        //['January', 'February', 'March', 'April', 'May', 'June', 'July']
        //[0, 10, 5, 2, 20, 30, 45]
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Number of visitors per day',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data,
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);
        $interests = $entityManager->getRepository(Interest::class)->findAll();
        $labels2 = [];
        $data2 = [];
        foreach( $interests as $interest){
            $labels2[] = $interest->getName();
            $data2[] = count($interest->getFeedbacks());
        }
        $chart2 = $chartBuilder->createChart(Chart::TYPE_PIE);
        $chart2->setData([
            'labels' => $labels2,
            'datasets' => [
                [
                    'backgroundColor' => ['rgb(120, 120, 255)','rgb(255, 99, 132)','rgb(255, 255, 132)','rgb(255, 99, 255)'],
                    'data' => $data2,
                ],
            ],
        ]);
        $chart2->setOptions([
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Most Popular Interests', // Your title text here
                ],
                ],
        ]);
        $labels3 = [];
        $data3 = [];
        foreach($infodays as $infoday){
            $labels3[] = (string) $infoday;
            $users = $infoday->getUsers();
            $feedbacks = [];
            foreach ($users as $user) {
                $feedback = $user->getFeedback();
                if($feedback != null){
                    $feedbacks[] = $feedback;
                }
            }
            $totalRatings = 0;
            $feedbackCount = count($feedbacks);
            foreach ($feedbacks as $feedback) {
                $totalRatings += $feedback->getRating();
            }
            $averageRating = $feedbackCount > 0 ? $totalRatings / $feedbackCount : 0;

            $data3[] = $averageRating;
        }
        $chart3 = $chartBuilder->createChart(Chart::TYPE_BAR);

        $chart3->setData([
            'labels' => $labels3,
            'datasets' => [
                [
                    'label' => 'Average rating per day',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data3,
                ],
            ],
        ]);
        $chart3->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 5,
                ],
            ],
        ]);
        return $this->render('overview/charts.html.twig', [
            'chart' => $chart,
            'chart2' => $chart2,
            'chart3' => $chart3,
        ]);
    }}