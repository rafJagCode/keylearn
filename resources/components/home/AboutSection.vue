<template>
	<section id="about">
		<div class="wave-rotated">
			<v-img :src="require('@/assets/img/borderWaves.svg')" />
		</div>
		<v-container fluid>
			<v-row align="center" justify="center">
				<v-col cols="10">
					<v-row align="center" justify="center">
						<v-col sm="5" class="hidden-sm-only">
							<v-img
								:src="require('@/assets/img/ill2.svg')"
								class="keyboard-icon d-block ml-auto mr-auto"
								max-width="350px"
							/>
						</v-col>
						<v-col cols="12" sm="7" class="white--text text-left about__text">
							<h1 class="font-weight-light display-1 mb-2">
								KeyLearn - most effective way to learn how to type.
							</h1>
							<h1 class="font-weight-light">
								Keep practicing by rewriting sets of words. It really doesn't
								take much to learn, a few minutes a day for one to two weeks.
								Check your progress by looking into your typing statistics and
								adjust your test settings to improve your progression.
							</h1>
						</v-col>
					</v-row>
				</v-col>
			</v-row>
		</v-container>
		<div class="svg-border-waves text-white">
			<v-img :src="require('@/assets/img/borderWaves.svg')" />
		</div>
	</section>
</template>

<style scoped>
#about {
	background-image: linear-gradient(
			rgba(255, 255, 255, 0.15),
			rgba(255, 255, 255, 0.15)
		),
		url('~@/assets/img/bgAbout.jpg');
	background-attachment: fixed;
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
	height: fit-content;
	padding-bottom: 10px;
}

#about .container,
#about .row {
	height: 100%;
}
.wave-rotated {
	position: absolute;
	top: 0;
	width: 100%;
	transform: rotate(180deg);
}
.wave-rotated .v-image {
	height: 30px;
}
.keyboard-icon {
	height: 300px;
	width: 300px;
}
.about__text {
	text-shadow: -1px -1px 0 black, 1px -1px 0 black, -1px 1px 0 black,
		1px 1px 0 black, -1px -1px 5px black, 1px -1px 5px black, -1px 1px 5px black,
		1px 1px 5px black;
}
</style>
