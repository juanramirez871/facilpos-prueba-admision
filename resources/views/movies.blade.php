<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Peliculas Facilpos</title>
        {{-- accede a los assets para traer la hoja de estilos de css --}}
        <link href="{{ URL::asset('assets/css/movies.css') }}" type="text/css" rel="stylesheet">
    </head>
    <body>
        <h1>Peliculas Facilpost - prueba admision</h1>
        <section style="display: flex">
            {{-- valida si ya se trajo la cartelera para no mostrar el boton --}}
            {{-- botone que trae la cartelera  --}}
            @if(!$movies)
                <form method="POST" action="{{ route('movies.post') }}">
                    @csrf
                    <button class="btn" type="submit" id="addBillBoard" style="background: #9acdff" >Traer cartelera</button>
                </form>
            @endif
            {{-- boton que elimina la cartelera --}}
                <form method="POST" action="{{ route('movies.delete') }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn" id="removeBillBoard" type="submit" style="background: #ff9a9a">Eliminar cartelera</button>
                </form>
        </section>
        <span class="loader" style="margin-top: 20px"></span>
        <section>
            {{-- valido si no me llegan datos mostrar el siguiente mensaje --}}
            @if(!$movies)
                <h1>¡La base de datos esta vacia! 😮</h1>
                {{-- en caso contrario recorrer cada pelicula y mostrar su informacion correspondiente --}}
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
                                {{ $movie["summary"] }}<br/><br/>
                                {{-- recorre los generos de la pelicula para mostrarlos --}}
                                    @foreach($movie["genders"] as $gender)
                                    <span class="label">{{ $gender["name"] }}</span>
                                    @endforeach
                            </p>
                            {{-- boton para eliminar una pelicula en especifico --}}
                            <form method="POST" action="{{ route('movie.delete', $movie["id"]) }}">
                                @csrf
                                @method('DELETE')
                                <button id="removeMovie" type="submit" class="delete" style="background: transparent; border: none">
                                    <img id="removeMovie" src="https://cdn-icons-png.flaticon.com/512/458/458594.png" />
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </section>

        {{-- se importa el archivo de js --}}
        <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    </body>
</html>
