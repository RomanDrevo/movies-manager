<template>
    <tr>
        <td>{{ mov.title }}</td>
        <td>{{ mov.writer }}</td>
        <td>
            <button type="button" class="btn-xs btn-success" @click.prervent="showEditMovieModal">
                More Details/Edit
            </button>


            <button type="button" class="btn-xs btn-danger" @click.prevent="showDeleteMovieModal">
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
            showDeleteMovieModal(){
                this.$emit('showDeleteMovieModal', this.mov, this.ind)
            },

            showEditMovieModal(){
                this.$emit('showEditMovieModal', this.mov)
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