<template>
  <section class="section-padding bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <div class="card p-4 shadow-sm border-0">
            <div class="card-body">
              <h1 class="mb-3">Kontak Kami</h1>
              <p class="text-muted mb-4">Silakan tinggalkan pesan, tim kami akan membantu Anda segera.</p>

              <form @submit.prevent="submitForm">
                <div class="mb-3">
                  <label class="form-label">Nama</label>
                  <input v-model="form.name" type="text" class="form-control" placeholder="Nama lengkap" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input v-model="form.email" type="email" class="form-control" placeholder="Email Anda" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">Subjek</label>
                  <input v-model="form.subject" type="text" class="form-control" placeholder="Judul pesan" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">Pesan</label>
                  <textarea v-model="form.message" class="form-control" rows="5" placeholder="Tuliskan pesan Anda" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
              </form>

              <div v-if="status.message" class="alert mt-4" :class="status.type">
                {{ status.message }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        subject: '',
        message: ''
      },
      status: {
        message: '',
        type: 'alert-success'
      }
    };
  },
  methods: {
    async submitForm() {
      this.status = { message: 'Mengirim...', type: 'alert-info' };
      try {
        const response = await fetch('/system879/contact', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: new URLSearchParams(this.form).toString()
        });

        if (response.redirected) {
          this.status = { message: 'Pesan berhasil dikirim. Kami akan menghubungi Anda.', type: 'alert-success' };
          this.form = { name: '', email: '', subject: '', message: '' };
        } else {
          this.status = { message: 'Terjadi kesalahan saat mengirim pesan.', type: 'alert-danger' };
        }
      } catch (error) {
        this.status = { message: 'Tidak dapat terhubung ke server.', type: 'alert-danger' };
      }
    }
  }
};
</script>

<style>
.section-padding {
  padding: 80px 0;
}
</style>
