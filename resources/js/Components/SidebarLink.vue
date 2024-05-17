<template>
    <li class="border-b-[1px] border-gray-200">
      <Link :href="href" :class="classes">
        <slot />
      </Link>
    </li>
  </template>

  <script>
  import { computed } from 'vue';
  import { Link } from '@inertiajs/vue3';

  export default {
    name: 'SidebarLink',
    components: {
        Link
    },
    props: {
      active : Boolean,
      href : String
    },
    setup(props) {
      const classes = computed(() => {
        return props.active
          ? 'flex items-center p-2 font-sans font-medium text-sm rounded-lg dark:text-white bg-blue-600 text-white hover:bg-blue-800 dark:hover:bg-gray-700 transition duration-150 ease-in-out'
          : 'flex items-center p-2 font-sans font-medium text-sm text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out';
      });

      return {
        classes
      };
    }
  };
  </script>
