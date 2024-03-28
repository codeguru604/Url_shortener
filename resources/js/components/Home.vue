<template>
  <div class="row mt-4">
    <h1>URL Shortener</h1>
    <LinksList />
    <CreateLink />
  </div>
</template>

<script setup>
import CreateLink from '../pages/CreateLink.vue';
import LinksList from './LinksList.vue';
import { provide } from 'vue';

//provide user id for the child components
//get props
const props = defineProps({
  user_id: {
    type: Number,
    required: true
  }
});

provide('user_id', props.user_id);
</script>

<style></style>