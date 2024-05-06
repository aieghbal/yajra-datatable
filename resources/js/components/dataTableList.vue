<template>
    <div>
        <h1>User List</h1>
        <ul>
            {{ users }}
        </ul>
    </div>
</template>

<script>
export default {
    props: ['users']
}
</script>
