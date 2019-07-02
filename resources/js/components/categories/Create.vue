<template>
	<div>
		<div class="bg-image">
			<div class="bg-primary-light">
				<div class="content content-full justify-content-between d-flex">
					<h1 class="font-size-h2 text-white my-0 d-inline-block">
						<i class="fa fa-plus text-white-50 mr-1"></i> Dodaj kategorijo
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
									<input type="text" class="form-control" v-model="title" required>
								</div>
							</div>

							<div class="form-group">
								<label for="content">Vsebina</label>
								<wysiwyg v-model="text" placeholder="Vnesi vsebino..."></wysiwyg>
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
			title: '',
			text: '',
		}
	},

	methods: {
		create() {

			axios.post('categories', {
					title: this.title,
					text: this.text
				})
				.then(response => {
					this.$router.push({
						name: 'categories',
						params: { msg: response.data }
					})
				})
				.catch(error => {
					console.log(error)
				})
		},
	}
}
</script>

<style lang="scss" scoped>

    label, h2 {
        color: #1C1C1C;
    }

    ::v-deep .editr .editr--content {
        height: 200px !important;
    }

</style>

