<template>
    <div class="link-form">
        <h2>Shorten Your Link</h2>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="original-url">Original URL:</label>
                <input
                    v-model="originalUrl"
                    id="original-url"
                    type="url"
                    placeholder="Enter your URL"
                    required
                />
            </div>
            <button type="submit">Shorten</button>
        </form>
        <div v-if="shortenedUrl" class="result">
            <p>Your shortened link:
                <a :href="shortenedUrl" target="_blank">{{ shortenedUrl }}</a>
            </p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            originalUrl: '',
            shortenedUrl: null,
        };
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('/api/shorten', { original_url: this.originalUrl });
                this.shortenedUrl = response.data.short_url;
            } catch (error) {
                console.error('Error shortening link:', error);
            }
        },
    },
};
</script>

<style scoped>
.link-form {
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    font-family: 'Arial', sans-serif;
}
h2 {
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}
form {
    display: flex;
    flex-direction: column;
}
.form-group {
    margin-bottom: 20px;
}
label {
    margin-bottom: 8px;
    font-weight: bold;
}
input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}
button {
    padding: 10px;
    font-size: 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
button:hover {
    background-color: #0056b3;
}
.result {
    margin-top: 20px;
    font-size: 18px;
    color: #333;
    text-align: center;
}
.result a {
    color: #007bff;
    text-decoration: none;
}
.result a:hover {
    text-decoration: underline;
}
</style>
