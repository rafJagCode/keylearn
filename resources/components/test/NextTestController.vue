<template>
	<div
		id="next-test-controller"
		style="
			 {
				width: 300px;
			}
		"
	>
		<Keypress
			key-event="keyup"
			:key-code="32"
			:modifiers="['ctrlKey', 'shiftKey']"
			@success="handleCtrlShiftSpaceKeypress()"
		/>
		<v-row justify="center">
			<v-layout
				column
				justify-center
				align-center
				class="primaryLight--text text-caption"
			>
				<span> PRESS CTRL + SHIFT + SPACE </span>
				<span> TO LOAD NEXT TEST </span>
			</v-layout>
			<v-icon x-large class="ml-4" color="creamy"
				>mdi-arrow-right-bold-box</v-icon
			>
		</v-row>
	</div>
</template>
<script>
export default {
	components: {
		Keypress: () => import('vue-keypress'),
	},
	methods: {
		handleCtrlShiftSpaceKeypress() {
			this.$emit('nextTest');
		},
	},
};
</script>
