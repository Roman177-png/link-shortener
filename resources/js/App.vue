<template>
    <div id="app">
        <LinkForm />
        <LinkList />
    </div>
</template>

<script>
import LinkForm from './components/LinkForm.vue';
import LinkList from './components/LinkList.vue';

export default {
    components: {
        LinkForm,
        LinkList,
    },
};
</script>
