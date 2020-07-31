import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ToastController} from '@ionic/angular';

@Component({
  selector: 'app-anunciar',
  templateUrl: './anunciar.page.html',
  styleUrls: ['./anunciar.page.scss'],
})
export class AnunciarPage implements OnInit {

  announceForm: FormGroup;

  constructor(public formbuilder: FormBuilder, public toastController: ToastController) { 
    this.announceForm = this.formbuilder.group({
      title: [null, [Validators.required, Validators.maxLength(100),]],
      people: [null, [Validators.required, Validators.max(99)]],
      bedrooms: [null, [Validators.required, Validators.max(99)]],
      beds: [null, [Validators.required, Validators.max(99)]],
      bathrooms: [null, [Validators.required, Validators.max(99)]],
    });
  }

  async presentToast() {
    const toast = await this.toastController.create({
      message: 'Anuncio criado com sucesso!',
      duration: 2000
    });
    toast.present();
  }

  submitForm(form) {
    console.log(form);
    console.log(form.value);
  }

  ngOnInit() {
  }

}
