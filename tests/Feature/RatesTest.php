<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RatesTest extends TestCase
{
    /**
     * Test rates index page loads
     */
    public function test_rates_index_page_loads(): void
    {
        // Try without locale first
        $response = $this->get('/rates');
        
        if ($response->status() === 200) {
            $response->assertSee('IFTA Rates & Tax Information');
            $response->assertSee('Current Quarter Rates');
        } else {
            // Try with default locale
            $response = $this->get('/en/rates');
            $response->assertStatus(200);
            $response->assertSee('IFTA Rates & Tax Information');
            $response->assertSee('Current Quarter Rates');
        }
    }

    /**
     * Test rates show page loads for valid year and quarter
     */
    public function test_rates_show_page_loads_for_valid_parameters(): void
    {
        $response = $this->get('/rates/2025/3');
        
        if ($response->status() === 200) {
            $response->assertSee('Third Quarter 2025');
            $response->assertSee('Fuel Tax Rates');
            $response->assertSee('Mileage Rates');
            $response->assertSee('IFTA Rates');
        } else {
            // Try with default locale
            $response = $this->get('/en/rates/2025/3');
            $response->assertStatus(200);
            $response->assertSee('Third Quarter 2025');
            $response->assertSee('Fuel Tax Rates');
            $response->assertSee('Mileage Rates');
            $response->assertSee('IFTA Rates');
        }
    }

    /**
     * Test rates show page returns 404 for invalid quarter
     */
    public function test_rates_show_page_returns_404_for_invalid_quarter(): void
    {
        $response = $this->get('/rates/2025/5');
        
        if ($response->status() !== 404) {
            $response = $this->get('/en/rates/2025/5');
            $response->assertStatus(404);
        } else {
            $response->assertStatus(404);
        }
    }

    /**
     * Test rates show page returns 404 for invalid year
     */
    public function test_rates_show_page_returns_404_for_invalid_year(): void
    {
        $response = $this->get('/rates/1999/1');
        
        if ($response->status() !== 404) {
            $response = $this->get('/en/rates/1999/1');
            $response->assertStatus(404);
        } else {
            $response->assertStatus(404);
        }
    }

    /**
     * Test rates show page displays correct quarter information
     */
    public function test_rates_show_page_displays_correct_quarter_info(): void
    {
        $response = $this->get('/rates/2025/2');
        
        if ($response->status() === 200) {
            $response->assertSee('Second Quarter 2025');
            $response->assertSee('April, May, June');
        } else {
            // Try with default locale
            $response = $this->get('/en/rates/2025/2');
            $response->assertStatus(200);
            $response->assertSee('Second Quarter 2025');
            $response->assertSee('April, May, June');
        }
    }

    /**
     * Test rates show page displays navigation between quarters
     */
    public function test_rates_show_page_displays_navigation(): void
    {
        $response = $this->get('/rates/2025/2');
        
        if ($response->status() === 200) {
            $response->assertSee('Q1');
            $response->assertSee('Q2');
            $response->assertSee('Q3');
            $response->assertSee('Q4');
        } else {
            // Try with default locale
            $response = $this->get('/en/rates/2025/2');
            $response->assertStatus(200);
            $response->assertSee('Q1');
            $response->assertSee('Q2');
            $response->assertSee('Q3');
            $response->assertSee('Q4');
        }
    }
}
