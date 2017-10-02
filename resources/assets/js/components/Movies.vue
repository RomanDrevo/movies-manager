<template>
    <div>
        <div class="row search-bar">
            <div class="col-sm-5">
                <button type="button" class="btn-xs btn-primary" @click.prervent="showAddMovieModal = true">
                    Add New Movie
                </button>
            </div>

            <div class="col-sm-7">
                <form @submit.prevent="getSearchResults" class="form-inline" id="filter-form">

                    <input class="form-control" type="text" v-model="keyword" @input="getSearchResults">
                    <div class="form-group">
                        <button class="btn-xs btn-success" type="submit">Search</button>
                    </div>
                    <button v-if="isSearched" class="btn-xs btn-default" @click.prevent="reload">Refresh</button>
                </form>
            </div>



        </div>


        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Title</th>
                <th>Writer</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <movie-row v-for="(movie, index) in movies.data" :key="index" :mov="movie" :ind="index" @showDeleteMovieModal="showDeleteMovieModal" @showEditMovieModal="showEditMovieModal"></movie-row>
            </tbody>
        </table>

        <modal v-if="showAddMovieModal" @confirm="addMovie" @close="showAddMovieModal = false" width="600">
            <h3 slot="header">

            </h3>
            <div class="form-group" slot="body">
                <div class="form-group">
                    <label>Enter movie title:</label>
                    <input type="text" v-model="newMovie.title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="writer">Enter writer:</label>
                    <input type="text" v-model="newMovie.writer" class="form-control">
                </div>

                <div class="form-group">
                    <label for="director">Enter movie director:</label>
                    <input type="text" v-model="newMovie.director" class="form-control">
                </div>

                <div class="form-group">
                    <label for="length">Enter movie length:</label>
                    <input type="number" v-model="newMovie.movie_length" class="form-control">
                </div>

                <div class="form-group">
                    <label for="title">Enter movie year:</label>
                    <input type="number" v-model="newMovie.movie_year" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Enter movie description:</label>
                    <textarea rows="4" v-model="newMovie.description" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="imdb_url">Enter movie IMDB Link:</label>
                    <input type="text" v-model="newMovie.imdb_url" class="form-control">
                </div>

                <div class="form-group">
                    <label for="imdb_rank">Enter movie IMDB Rank:</label>
                    <input type="number" v-model="newMovie.imdb_rank" class="form-control">
                </div>
            </div>
        </modal>

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
                    <textarea rows="4" v-model="selectedMovie.description" id="description" class="form-control"></textarea>
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

        <pagination :current_page="moviesData.current_page"
                    :prev_page_url="moviesData.prev_page_url"
                    :last_page="moviesData.last_page"
                    :next_page_url="moviesData.next_page_url"
                    :url_path="url"
                    :total="moviesData.total"
                    name="movies.data"
                    :per_page="moviesData.per_page"
                    :updateRecords="updateRecords">
        </pagination>
    </div>
</template>

<script type="text/babel">

    export default {
       data(){
           return {
               keyword: "",
               isSearched: false,
               moviesData:{},
               movies: [],
               newMovie:{
                   title: "",
                   writer: "",
                   director: "",
                   movie_length: "",
                   movie_year: "",
                   description: "",
                   imdb_url: "",
                   imdb_rank: ""
               },
               showDeleteModal: false,
               showEditModal: false,
               showAddMovieModal: false,
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
            this.getMovies('/api/movies/get-movies')
       },

        computed: {
            url() {
                let tempUrl = "/api/movies/get-movies";
                return this.type ? tempUrl + "?type=" + this.type + "&" : tempUrl + "?";
            }
        },

       methods: {

           updateRecords(e){
               let httpPath = e.target.getAttribute("href");
               this.getMovies(httpPath);
           },

           getMovies(url){
               this.$http.get(url)
                       .then(response => {
                           console.log(response.body.data);
                           this.moviesData = response.body.data;
                           this.movies = response.body.data;
                       })
           },

           deleteMovie(movieId, index){
                this.$http.post('/api/movies/' + movieId + '/delete', {movieId: movieId})
                        .then(response => {
                            this.movies.data.splice(index, 1);
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
               this.$http.post('/api/movies/' + movieId + '/update', this.selectedMovie)
                       .then(response => {
                           console.log(response);
                       });

               this.showEditModal = false;
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
           },

           addMovie(){
               this.$http.post('/api/movies/store', this.newMovie)
                       .then(response => {
                           console.log(response);
                       });

               this.showAddMovieModal = false;

               this.movies.data.unshift(this.newMovie)
           },

           getSearchResults() {

               let keyword = this.keyword;

               let tempUrl = '/api/movies/get-movies?keyword=' + keyword;

               this.getMovies(tempUrl);
               this.isSearched = true;
           },

           reload(){
               this.getMovies('/api/movies/get-movies');
               this.isSearched = false;
               this.keyword = '';
           }
       },

        components: {

        }
    }
</script>

<style scoped>
.search-bar{
    margin: 1%;
}
</style>