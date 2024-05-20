<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';

export default {
  components: {
    Head,
    Link,
    AuthenticationCard,
    AuthenticationCardLogo,
    Checkbox,
    InputError,
    InputLabel,
    PrimaryButton,
    TextInput
  },
  props: {
    canResetPassword: Boolean,
    status: String
  },
  setup() {
    const email = ref('');
    const password = ref('');
    const remember = ref(false);

    const form = useForm({
      email: email.value,
      password: password.value,
      remember: remember.value ? 'on' : ''
    });

    const submit = () => {
      form.post(route('login.auth'), {
        onFinish: () => {
          form.reset('password');
          password.value = '';
        }
      });
    };

    return {
      email,
      password,
      remember,
      form,
      submit
    };
  }
};
</script>

<template>
  <Head title="Log in" />

  <AuthenticationCard>
    <template #logo>
      <AuthenticationCardLogo />
    </template>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="email" value="Email" />
        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="username"
        />
        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Password" />
        <TextInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="current-password"
        />
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <Checkbox v-model:checked="form.remember" name="remember" />
          <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Log in
        </PrimaryButton>
      </div>
    </form>
  </AuthenticationCard>
</template>
