<template>
  <div class="min-h-screen flex items-stretch text-white">
    <div id="picrueBackground" class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center"
         v-bind:style="{ backgroundImage: 'url(' + imageUrl()+ ')' }" @loadeddata="isLoaded = true" v-if="isLoaded">
      <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
      <div class="w-full px-24 z-10">
        <h1 class="text-5xl font-bold text-left tracking-wide">{{ this.titel }}</h1>
        <p class="text-3xl my-4">{{ this.subtitel }}</p>
      </div>
    </div>
      <img v-if="!isLoaded" :src="imageUrl()" @load="imageLoaded()" alt="">
    <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0"
         style="background-color: #064b4f;" v-if="isLoaded">
        <div class=" bg-black opacity-60 inset-0 z-0"></div>
          <div class="w-full py-6 z-20">
           <slot></slot>

          </div>
        </div>
  </div>
</template>

<script>
export default {
  name: 'InfoDisplayer',
  props:['titel','subtitel','imgSrc'],
  methods:{
    imageUrl(){
        return this.imgSrc||this.defaultImgSrc;
    },
    imageLoaded(){
        this.isLoaded = true;
    }
  },
  data() {
    return {
        defaultImgSrc: "https://picsum.photos/800/1200/",
        isLoaded: false,
    }
  },
  created() {
      setTimeout(() => {
          if (!this.isLoaded){
              this.imgSrc = "https://picsum.photos/800/1000/";
              this.defaultImgSrc = "https://picsum.photos/800/1000/";
          }
      },5000);
  }
}
</script>


