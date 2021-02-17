<template>
  <div class="typing-machine-icon">
    <img
      class="typing-machine-icon__svg"
      :class="{ 'typing-machine-icon__svg--shaking': isIconShaking }"
      :src="require('@/assets/img/typing-machine-icon.svg')"
      alt="typing-machine-icon"
    />
  </div>
</template>
<script>
export default {
  name: "TypingMachineIcon",
  props: {
    isIconShaking: false,
  },
};
</script>
<style scoped>
.typing-machine-icon__svg {
  margin: 0 auto;
  width: 250px;
  transform: rotate(-5deg);
}
.typing-machine-icon__svg--shaking {
  animation: shake 1s cubic-bezier(0.36, 0.07, 0.19, 0.97) infinite both;
  transform: translate3d(0, 0, 0);
  backface-visibility: hidden;
  perspective: 1000px;
}
@keyframes shake {
  10%,
  90% {
    transform: translate3d(-1px, 0, 0);
  }
  20%,
  80% {
    transform: translate3d(2px, 0, 0);
  }
  30%,
  50%,
  70% {
    transform: translate3d(-4px, 0, 0);
  }
  40%,
  60% {
    transform: translate3d(4px, 0, 0);
  }
}
</style>
