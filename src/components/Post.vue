<template>
    <div class="post">
      <router-link :to="{ name: 'main'}">К списку новостей</router-link>
      <h3>{{ post.title }}</h3>
      <p>{{ post.body }}</p>

      <h3>Комментарии</h3>
      <ul>
        <li v-for="comment in comments" :key="comment.id">
          <span>{{ comment.email }}<br></span>
          {{ comment.name }}<br>
          {{ comment.body }}
        </li>
      </ul>
    </div>
</template>

<script>
import PostService from '@/services/PostService'
import CommentService from '@/services/CommentService'

export default {
  name: 'Post',
  data () {
    return {
      post: {
        id: this.$route.params.id,
        title: '',
        body: ''
      },
      comments: []
    }
  },
  mounted () {
    this.getPost()
    this.getComments()
  },
  methods: {
    async getPost () {
      const response = await PostService.getPost(this.post.id)
      this.post = response.data[0]
    },
    async getComments () {
      const response = await CommentService.getComment(this.post.id)
      this.comments = response.data
    }
  }
}
</script>

<style>
    body{
        font-family: Helvetica, Arial, sans-serif;
    }
    div{
        width:80%;
margin: auto;
        padding:10px 20px;
    }
    div a{
        font-size:14px;
        color:#9c9898;
    }
    div h3{
        text-transform:uppercase;
        border-bottom: 2px solid #005394;
        color:#005394;
    }

    ul{
        list-style:none;
    }
    ul li{
        font-size:14px;
        margin-bottom:15px;
    }
    ul li span{
        font-weight:600;
        padding-bottom:5px;
    }
</style>