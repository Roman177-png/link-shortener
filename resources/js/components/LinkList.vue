<template>
    <div class="link-list">
        <h2>List of Shortened Links</h2>
        <table>
            <thead>
            <tr>
                <th>Original URL</th>
                <th>Shortened URL</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="link in links" :key="link.short_code">
                <td>
                    <a :href="link.original_url" target="_blank" class="original-url">
                        {{ link.original_url }}
                    </a>
                </td>
                <td>
                    <a :href="link.short_url" target="_blank" class="short-url">
                        {{ link.short_code }}
                    </a>
                </td>
                <td>
                    <button @click="deleteLink(link.short_code)" class="delete-btn">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            links: [],
        };
    },
    async mounted() {
        await this.fetchLinks();
    },
    methods: {
        async fetchLinks() {
            try {
                const response = await axios.get('/api/links');
                this.links = response.data.map(link => ({
                    ...link,
                    short_url: `${window.location.origin}/${link.short_code}`,
                }));
            } catch (error) {
                console.error('Error fetching links:', error);
            }
        },
        async deleteLink(shortCode) {
            try {
                await axios.delete(`/api/${shortCode}`);
                this.fetchLinks();
            } catch (error) {
                console.error('Error deleting link:', error);
            }
        },
    },
};
</script>

<style scoped>
.link-list {
    max-width: 900px;
    margin: 40px auto;
    font-family: 'Arial', sans-serif;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
th, td {
    border: 1px solid #ddd;
    text-align: left;
    padding: 10px;
}
th {
    background-color: #f8f9fa;
    font-weight: bold;
}
tr:nth-child(even) {
    background-color: #f9f9f9;
}
.original-url, .short-url {
    color: #007bff;
    text-decoration: none;
    word-break: break-word;
}
.original-url:hover, .short-url:hover {
    text-decoration: underline;
}
.delete-btn {
    background-color: #ff4d4d;
    color: white;
    border: none;
    padding: 6px 12px;
    cursor: pointer;
    border-radius: 4px;
}
.delete-btn:hover {
    background-color: #ff1a1a;
}
</style>
