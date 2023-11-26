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
                            @if(strpos($movie["poster"], "http") === 0)
                                <img src="{{ $movie["poster"] }}" alt="peliculas">
                            @else
                                <img src="https://image.tmdb.org/t/p/w500{{ $movie["poster"] }}" alt="peliculas">
                            @endif
                        <div class="info">
                            <h2 class="p10">{{ $movie["name"] }}</h2>
                            <b class="p10">titulo original:</b>
                            <p class="p10">{{ $movie["title"] }}</p>
                            <b class="p10">Lenguaje original: </b><span>{{ $movie["lenguage"] }}</span>
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
                            <button id="editMovie" data-id="{{ $movie["id"] }}" type="submit" class="btnEditar">Editar</button>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </section>

        {{-- Mpdal donde se editara la pelicula seleccionada --}}
        <section class="modal">
            <div>
                <img class="imgModal" id="poster" src="" alt="peliculas">
            </div>
            <div>
                <div>
                    <form method="POST" id="formModal" action="">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name">Pelicula:</label>
                            <input type="text" id="name" name="name" value="alguna pelicula" required>
                            <input type="hidden" name="poster" id="inputPoster">
                        </div>
                        <div>
                            <label for="title">Titulo original:</label>
                            <input type="text" id="title" name="title" value="alguna pelicula original" required>
                        </div>
                        <div>
                            <label for="lenguage">Lenguage original:</label>
                            <input type="text" id="lenguage" name="lenguage" value="Es" required>
                        </div>
                        <div>
                            <label for="summary">Sinopsis:</label>
                            <textarea type="text" id="summary" name="summary" required >alguna sinopsis</textarea>
                        </div>
                        <button class="saveEdit" type="submit">Editar</button>
                    </form>
                </div>
                <img id="closeModal" src="https://cdn-icons-png.flaticon.com/512/458/458594.png" />
            </div>
        </section>

        {{-- se importa el archivo de js --}}
        <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    </body>
</html>
