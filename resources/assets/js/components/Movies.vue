<template>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Title</th>
                <th>Writer</th>
                <th>Director</th>
                <th>Length</th>
                <th>Year</th>
                <th>Description</th>
                <th>IMDB Link</th>
                <th>IMDB Rank</th>
                <th>Edit/Delete</th>
            </tr>
            </thead>
            <tbody>
            <movie-row v-for="(movie, index) in movies" :key="index" :mov="movie" :ind="index" @showDeleteMovieModal="showDeleteMovieModal" @showEditMovieModal="showEditMovieModal"></movie-row>
            </tbody>
        </table>

        <modal v-if="showDeleteModal" @confirm="deleteMovie(selectedMovie.id, selectedMovieIndex)" @close="showDeleteModal = false" width="600">
            <h3 slot="header">

            </h3>
            <div class="form-group" slot="body">
                You are about to delete the movie record. Are you sure?
            </div>
        </modal>

        <modal v-if="showEditModal" @confirm="editMovie(selectedMovie.id)" @close="showEditModal = false" width="600">
            <h3 slot="header">

            </h3>
            <div class="form-group" slot="body">
                <div class="form-group">
                    <label for="title">Enter movie title:</label>
                    <input type="text" v-model="selectedMovie.title" id="title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="writer">Enter writer:</label>
                    <input type="text" v-model="selectedMovie.writer" id="writer" class="form-control">
                </div>

                <div class="form-group">
                    <label for="director">Enter movie director:</label>
                    <input type="text" v-model="selectedMovie.director" id="director" class="form-control">
                </div>

                <div class="form-group">
                    <label for="length">Enter movie length:</label>
                    <input type="number" v-model="selectedMovie.movie_length" id="length" class="form-control">
                </div>

                <div class="form-group">
                    <label for="title">Enter movie year:</label>
                    <input type="number" v-model="selectedMovie.movie_year" id="year" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Enter movie description:</label>
                    <input type="text" v-model="selectedMovie.description" id="description" class="form-control">
                </div>

                <div class="form-group">
                    <label for="imdb_url">Enter movie IMDB Link:</label>
                    <input type="text" v-model="selectedMovie.imdb_url" id="imdb_url" class="form-control">
                </div>

                <div class="form-group">
                    <label for="imdb_rank">Enter movie IMDB Rank:</label>
                    <input type="number" v-model="selectedMovie.imdb_rank" id="imdb_rank" class="form-control">
                </div>

            </div>
        </modal>
    </div>
</template>

<script type="text/babel">

    export default {
       data(){
           return {
               movies: [],
               showDeleteModal: false,
               showEditModal: false,
               selectedMovie: {},
               selectedMovieIndex: "",
               title: "",
               writer: "",
               director: "",
               movie_length: "",
               movie_year: "",
               description: "",
               imdb_url: "",
               imdb_rank: ""
           }
       },

       mounted(){
            this.$http.get('/api/movies')
                    .then(response => {
                        console.log(response.body.data);
                        this.movies = response.body.data;
                    })
       },

       methods: {
           deleteMovie(movieId, index){
                this.$http.post('/api/movies/' + movieId + '/delete', {movieId: movieId})
                        .then(response => {
                            this.movies.splice(index, 1);
                            console.log(response);
                        });

                this.showDeleteModal = false;
                this.selectedMovie = {};
                this.selectedMovieIndex = '';
           },
           showDeleteMovieModal(movie, index){
               this.showDeleteModal = true;
               this.selectedMovie = movie;
               this.selectedMovieIndex = index;
           },

           editMovie(movieId){

               let data = {
                   title: this.selectedMovie.title,
                   writer: this.selectedMovie.writer,
                   director: this.selectedMovie.director,
                   movie_length: this.selectedMovie.movie_length,
                   movie_year: this.selectedMovie.movie_year,
                   description: this.selectedMovie.description,
                   imdb_url: this.selectedMovie.imdb_url,
                   imdb_rank: this.selectedMovie.imdb_rank
               };

               this.$http.post('/api/movies/' + movieId + '/update', this.selectedMovie)
                       .then(response => {
                           console.log(response);
                       });
           },

           showEditMovieModal(movie){
               this.showEditModal = true;
               this.selectedMovie = movie;

               this.title = movie.title;
               this.writer = movie.writer;
               this.director = movie.director;
               this.movie_length = movie.movie_length;
               this.movie_year = movie.movie_year;
               this.description = movie.description;
               this.imdb_url = movie.imdb_url;
               this.imdb_rank = movie.imdb_rank;
           }
       },

        components: {

        }
    }
</script>

<style scoped>

</style>