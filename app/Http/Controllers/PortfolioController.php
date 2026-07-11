<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    /**
     * Display the portfolio index page with Lyshan Dave's authentic structured data.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Portfolio', $this->getPortfolioData());
    }

    /**
     * Display the full Tech Stack page.
     *
     * @return \Inertia\Response
     */
    public function techStack()
    {
        $data = $this->getPortfolioData();
        return Inertia::render('TechStack', [
            'profile' => $data['profile'],
            'techStack' => $data['techStack'],
        ]);
    }

    /**
     * Display the full Projects page.
     *
     * @return \Inertia\Response
     */
    public function projects()
    {
        $data = $this->getPortfolioData();
        return Inertia::render('Projects', [
            'profile' => $data['profile'],
            'projects' => $data['projects'],
        ]);
    }

    /**
     * Display the full Certifications page.
     *
     * @return \Inertia\Response
     */
    public function certifications()
    {
        $data = $this->getPortfolioData();
        return Inertia::render('Certifications', [
            'profile' => $data['profile'],
            'all_certifications' => $data['all_certifications'],
        ]);
    }

    /**
     * Get Lyshan Dave's authentic structured portfolio data.
     *
     * @return array
     */
    public function getPortfolioData()
    {
        return config('portfolio');
    }
}
