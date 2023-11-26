<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
    public function testdeleteMoviesRoute()
    {
        // se especifica que la siguiente ruta de un estado 200
        $response = $this->get(route('movies.delete'));
        $response->assertStatus(200);
    }

    public function testpostMoviesRoute()
    {
        // se especifica que la siguiente ruta de un estado 200
        $response = $this->get(route('movies.post'));
        $response->assertStatus(200);
    }
    public function testGetMoviesRoute()
    {
        $response = $this->get(route('movies.get'));
        // Verificar que los datos de la película se pasan correctamente a la vista
        $response->assertViewHas('movies');
        $movie = Movie::first();
        $response->assertSee($movie->title);
        // se especifica que la siguiente ruta de un estado 200
        $response->assertStatus(200);
    }
    public function testdeleteMovieRoute()
    {
        // se especifica que la siguiente ruta de un estado 302, porque esta ruta redirecciona
        $movie = Movie::first();
        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->delete(route('movie.delete', ['movie' => $movie -> id]));
        $response->assertStatus(302);
    }
}
