<template>
  <GuestLayout>
    <Head title="About" />
    <div class="bg-white min-h-screen">
      <div class="container px-5 py-24 mx-auto">
        <div class="mb-24">
          <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Welcome</h1>
          <p class="text-gray-700 text-lg leading-relaxed">
              Dive into a thriving community of passionate pet enthusiasts who share a common love for their furry, feathered, and scaled companions. Whether you're a proud cat parent, a devoted dog lover, or the proud owner of exotic pets, our social network is the perfect haven for you. Connect with like-minded individuals who understand the joys and challenges of caring for and rescuing animals.
          </p>
          <p class="text-gray-700 text-lg leading-relaxed mt-4">
              Share heartwarming stories, exchange valuable tips on pet care, and revel in the endless stream of adorable photos and videos. Rescue House isn't just a network; it's a digital sanctuary where the bond between humans and their animal friends is celebrated in all its forms.
          </p>
          <p class="text-gray-700 text-lg leading-relaxed mt-4">
              Join us in creating a tapestry of love and laughter that stretches across the diverse landscape of pet ownership. Welcome to a community that understands the language of paws, feathers, and fins — Rescue House, where every pet has a story, and every owner has a friend.
          </p>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>

  import { Head } from '@inertiajs/vue3';

  import GuestLayout from "@/Layouts/GuestLayout.vue";

</script>