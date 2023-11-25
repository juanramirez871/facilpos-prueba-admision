<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
    public function testGetMoviesRoute()
    {
        $response = $this->get(route('movies.get'));
        $response->assertStatus(200);
    }
    public function testdeleteMoviesRoute()
    {
        $response = $this->get(route('movies.delete'));
        $response->assertStatus(200);
    }

    public function testpostMoviesRoute()
    {
        $response = $this->get(route('movies.post'));
        $response->assertStatus(200);
    }
    public function testdeleteMovieRoute()
    {
        $movie = 8;
        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->delete(route('movie.delete', ['movie' => $movie]));
        $response->assertStatus(302);
    }
}
