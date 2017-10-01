<template>
    <tr>
        <td>{{ mov.title }}</td>
        <td>{{ mov.writer }}</td>
        <td>{{ mov.director }}</td>
        <td>{{ mov.movie_length }}</td>
        <td>{{ mov.movie_year }}</td>
        <td>{{ mov.description }}</td>
        <td>{{ mov.imdb_url }}</td>
        <td>{{ mov.imdb_rank }}</td>
        <td>
            <button type="button" class="btn-xs btn-success" @click="">
                Edit
            </button>


            <button type="button" class="btn-xs btn-danger" @click.prevent="showDeleteModal">
                Delete
            </button>
        </td>
    </tr>
</template>

<script type="text/babel">

    export default{
        name: 'movie-row',
        data(){
            return{

            }
        },
        props:{
            mov: {
                required: true
            },
            ind: {
                required: true
            }
        },
        methods:{
            showDeleteModal(){
                this.$emit('showModal', this.mov, this.ind)
            }
        },
        components:{

        }
    }
</script>

<style scoped>
     .btn-xs, .btn-group-xs > .btn {
        padding: 1px 5px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
        margin: 2px;
    }
</style>