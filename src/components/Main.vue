<template>
  <div>
    <h1>Новости мира и Казахстана</h1>
    <posts></posts>
  </div>
</template>

<script>
import Posts from '@/components/Posts'

export default {
  name: 'Main',
  components: {
    Posts
  }
}
</script>
<style>
    h1{
        text-align:center;
        border-bottom:2px solid #005394;
    }
    body {
      font-family: Arial, sans-serif;
    }
    input{
        width:300px;
        height:40px;
    
    }
</style>