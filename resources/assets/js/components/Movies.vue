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

        <modal v-if="showEditModal" @confirm="" @close="showEditModal = false" width="600">
            <h3 slot="header">

            </h3>
            <div class="form-group" slot="body">
                You are about to EDIT the movie record. Are you sure?
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
               selectedMovieIndex: ""
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
           },
           showDeleteMovieModal(movie, index){
               this.showDeleteModal = true;
               this.selectedMovie = movie;
               this.selectedMovieIndex = index;
           },

           showEditMovieModal(movie, index){
               this.showEditModal = true;
           }
       },

        components: {

        }
    }
</script>

<style scoped>

</style>