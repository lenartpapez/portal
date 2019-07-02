<template>
	<div>
		<div class="bg-image">
			<div class="bg-primary-light">
				<div class="content content-full justify-content-between d-flex">
					<h1 class="font-size-h2 text-white my-0 d-inline-block">
						<i class="fa fa-plus text-white-50 mr-1"></i> Dodaj povezavo
					</h1>
					<a class="btn btn-light" @click="$router.go(-1)">
						<i class="fas fa-arrow-left"></i> Nazaj
					</a>
				</div>
			</div>
		</div>
		<div class="content">
			<div v-if="message !== ''" v-bind:class="{ 'alert-success': !error, 'alert-danger': error }" class="alert mb-3">
                {{ message }}
            </div>
			<div class="block block-rounded block-bordered" id="createPostBlock">
				<div class="block-content">
					<h2 class="content-heading pt-0">Osnovne informacije</h2>
					<div class="row push">
						<div class="col-xl-4 col-12">
							<p class="text-muted">Podatki</p>
						</div>
						<div class="col-lg-10 col-xl-8">

							<div class="form-group row">
								<div class="col-lg-12">
									<label for="category">Kategorija</label>
									<select v-model="category" class="form-control" required>
										<option v-for="category of categories" :value="category.id" :key="category.id">
											{{ category.title }}
										</option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-lg-12">
									<label for="title">Tekst</label>
									<input type="text" class="form-control" v-model="text" required>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-lg-12">
									<label for="title">URL</label>
									<input type="url" validate class="form-control" v-model="url" required>
								</div>
							</div>
						</div>
					</div>

					<div class="row push">
						<div class="col-lg-10 col-xl-8 offset-xl-4">
							<div class="form-group">
								<button v-on:click="create" class="btn btn-lg btn-primary">
									<i class="fa fa-save"></i> Ustvari
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

export default {

	data() {
		return {
			error: false,
			message: '',
			category: null,
			text: '',
			url: '',
			categories: []
		}
	},

	mounted() {
		this.getCategories();
	},

	methods: {
		create() {
			var isUrl = require('is-url');
			if(isUrl(this.url)) {
				axios.post('links', {
					category: this.category,
					text: this.text,
					url: this.url
				})
				.then(response => {
					this.$router.push({
						name: 'links',
						params: { msg: response.data }
					})
				})
				.catch(error => {
					console.log(error)
				})
			} else {
				this.error = true;
				this.message = 'URL ni v pravilnem formatu.';
			}
		},

		getCategories() {
			axios.get('categories')
			.then(response => {
				this.categories = response.data;
			})
			.catch(error => {});
		}
	}
}
</script>

<style>
</style>>

