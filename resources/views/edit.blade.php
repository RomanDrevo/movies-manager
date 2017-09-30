<form method="POST" action="/api/movies/{{$movie->id}}/update">

    {{--<input name="_method" type="hidden" value="POST">--}}

    {!! csrf_field() !!}
    <input type="text" name="title" placeholder="title">
    <input type="text" name="writer" placeholder="writer">
    <input type="text" name="director" placeholder="director">
    <input type="number" name="movie_length" placeholder="Length">
    <input type="number" name="movie_year" placeholder="Yaer">
    <input type="text" name="description" placeholder="Desc">
    <input type="text" name="imdb_url" placeholder="URL">
    <input type="number" name="imdb_rank" placeholder="Rank">
    <input type="submit" value="send">
</form>