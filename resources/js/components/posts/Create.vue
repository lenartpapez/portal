<template>
	<form method="post" @submit.stop.prevent="create" enctype="multipart/form-data">
		<div class="bg-image">
			<div class="bg-primary-light">
				<div class="content content-full justify-content-between d-flex">
					<h1 class="font-size-h2 text-white my-0 d-inline-block">
						<i class="fa fa-plus text-white-50 mr-1"></i> Dodaj novico
					</h1>
					<a class="btn btn-light" @click="$router.go(-1)">
						<i class="fas fa-arrow-left"></i> Nazaj
					</a>
				</div>
			</div>
		</div>
		<div class="content">
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
									<label for="title">Naslov</label>
									<input type="text" id="title" class="form-control" name="title" v-model="title" required>
								</div>
							</div>

							<div class="form-group">
								<label for="content">Vsebina</label>
								<wysiwyg v-model="content" placeholder="Vnesi vsebino..."></wysiwyg>
							</div>

							<div class="form-group row">
								<div class="col-lg-12">
									<label for="title">Slika</label>
									<picture-input
										ref="imageInput"
										width="300"
										height="300"
										margin="40"
										accept="image/jpeg, image/png"
										size="1.5"
										:removable="true"
										button-class="btn btn-primary"
										:custom-strings="{upload: '<h1>Neuspešno!</h1>', drag: 'Povleci sliko ali klikni na to okno', change: 'Zamenjaj', remove: 'Odstrani'}"
										@change="onChange"
										@remove="onRemove"
									></picture-input>
								</div>
							</div>
						</div>
					</div>

					<div class="row push">
						<div class="col-lg-10 col-xl-8 offset-xl-4">
							<div class="form-group">
								<button type="submit" class="btn btn-lg btn-primary">
									<i class="fa fa-save"></i> Objavi
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</template>

<script>
import PictureInput from 'vue-picture-input'

export default {
	data() {
		return {
			title: '',
			content: '',
			image: null
		}
	},

	components: {
		PictureInput
	},

	methods: {
		create() {
			let formData = new FormData()
			formData.append('title', this.title)
			formData.append('content', this.content)

			if (this.image !== null) {
				formData.append('image', this.image)
			}

			axios
				.post('posts', formData, {
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
				.then(response => {
					this.$router.push({
						name: 'posts',
						params: { msg: response.data }
					})
				})
				.catch(error => {
					console.log(error)
				})
		},
		onChange(image) {
			if (image) {
				this.image = this.$refs.imageInput.file
			} else {
				console.log(
					'FileReader API not supported: use the <form>, Luke!'
				)
			}
		},

		onRemove(image) {
			if (image) {
				this.image = null
			}
		}
	}
}
</script>

<style>
</style>>

