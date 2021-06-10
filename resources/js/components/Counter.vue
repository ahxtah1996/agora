<template>
  <span>{{hour}}:{{min}}:{{sec}}</span>
</template>

<script>
export default {
  props: ["hour", "min", "sec"],
};
</script>