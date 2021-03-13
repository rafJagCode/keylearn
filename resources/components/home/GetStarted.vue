<template>
	<section id="get-started">
		<v-parallax dark :src="require('@/assets/img/bgHero.jpg')" height="750">
			<v-row align="center" justify="center">
				<v-col cols="10">
					<v-row align="center" justify="center">
						<v-col cols="12" md="4">
							<h1 class="get-started__text display-3 font-weight-bold mb-4">
								KeyLearn
							</h1>
							<h1 class="get-started__text display-1 font-weight-light">
								Easily practice your typing skills and improve your typing
								speed!
							</h1>
							<v-btn
								rounded
								outlined
								large
								dark
								@click="$vuetify.goTo('#features')"
								class="mt-5"
								@mouseenter.native="shakeOn"
								@mouseleave.native="shakeOff"
							>
								Get Started
								<v-icon class="ml-2">mdi-arrow-down</v-icon>
							</v-btn>
						</v-col>
						<v-col cols="12" md="8">
							<typing-machine-icon
								:isIconShaking="isIconShaking"
							></typing-machine-icon>
						</v-col>
					</v-row>
				</v-col>
			</v-row>
			<div class="svg-border-waves text-white">
				<v-img :src="require('@/assets/img/borderWaves.svg')" />
			</div>
		</v-parallax>
		<v-container fluid id="features" class="mt-2">
			<v-row align="center" justify="space-around">
				<v-col
					cols="12"
					xs="12"
					sm="6"
					md="4"
					class="text-center"
					v-for="(card, index) in cards"
					:key="index"
				>
					<router-link :to="card.cardLink">
						<about-card
							size="400"
							:icon="card.icon"
							:caption="card.caption"
							:description="card.description"
						></about-card>
					</router-link>
				</v-col>
			</v-row>
		</v-container>
	</section>
</template>

<script>
import aboutCard from '@/components/utils/AboutCard';
import typingMachineIcon from '@/components/utils/TypingMachineIcon';
export default {
	data() {
		return {
			cards: [
				{
					cardLink: 'register',
					icon: 'sign-up-icon',
					caption: 'sign up',
					description:
						'Creating account will allow you to control your learning progress. Sign up to get access to your learning statistics.',
				},
				{
					cardLink: 'test',
					icon: 'typing-practice-icon',
					caption: 'practice typing',
					description:
						'Start your training. Check how fast and accurate is your typing.',
				},
				{
					cardLink: 'register',
					icon: 'graph-bar',
					caption: 'analyze the results',
					description: 'Sign up to check your learning results.',
				},
			],
			isIconShaking: false,
		};
	},
	methods: {
		shakeOn() {
			this.isIconShaking = true;
		},
		shakeOff() {
			this.isIconShaking = false;
		},
	},
	components: {
		'about-card': aboutCard,
		'typing-machine-icon': typingMachineIcon,
	},
};
</script>

<style>
.svg-border-waves .v-image {
	position: absolute;
	bottom: 0;
	left: 0;
	height: 3rem;
	width: 100%;
	overflow: hidden;
}

#get-started {
	z-index: 0;
}
.get-started__text {
	text-shadow: -0.5px -0.5px 0.5px #0095a6, 0.5px -0.5px 0.5px #0095a6,
		-0.5px 0.5px 0.5px #0095a6, 0.5px 0.5px 0.5px #0095a6;
}
section {
	position: relative;
}
</style>
