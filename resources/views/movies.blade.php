<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Peliculas Facilpos</title>
        <link href="{{ URL::asset('assets/css/movies.css') }}" type="text/css" rel="stylesheet">
    </head>
    <body>
        <h1>Peliculas Facilpost - prueba admision</h1>
        <section style="display: flex">
            <form method="POST" action="{{ route('movies.post') }}">
                @csrf
                <button class="btn" type="submit" style="background: #9acdff" >Traer cartelera</button>
            </form>
            <form method="POST" action="{{ route('movies.delete') }}">
                @csrf
                @method('DELETE')
                <button class="btn" type="submit" style="background: #ff9a9a">Eliminar cartelera</button>
            </form>
        </section>
        <section>
            @if(!$movies)
                <h1>¡La base de datos esta vacia! 😮</h1>
                @else
                <div class="containerMovies">
                @foreach($movies as $movie)
                    <div class="card">
                        <img src="https://image.tmdb.org/t/p/w500{{ $movie["poster"] }}" alt="peliculas">
                        <div class="info">
                            <h2 class="p10">{{ $movie["name"] }}</h2>
                            <b class="p10">titulo original:</b>
                            <p class="p10">{{ $movie["title"] }}</p>
                            <b class="p10">Lenguaje original: <span>{{ $movie["lenguage"] }}</span></b><br/>
                            <p class="p10 summary">
                                {{ $movie["summary"] }}
                            </p>
                            <form method="POST" action="{{ route('movie.delete', $movie["id"]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete" style="background: transparent; border: none">
                                    <img src="https://cdn-icons-png.flaticon.com/512/458/458594.png" />
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </section>
    </body>
</html>
