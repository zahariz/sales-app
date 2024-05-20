<template>
    <div class="flex items-center">
      <div class="flex w-full bg-white rounded shadow">

        <input class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autocomplete="off" type="text" name="search" placeholder="Search…" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
      </div>
      <button class="ml-3 text-gray-500 hover:text-gray-700 focus:text-indigo-500 text-sm" type="button" @click="$emit('reset')">Reset</button>
    </div>
  </template>

  <script>

  export default {
    props: {
      modelValue: String,

    },
    emits: ['update:modelValue', 'reset'],
  }
  </script>
