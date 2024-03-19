import {Component, OnInit} from '@angular/core';
import {Tutor} from "../../model/tutor";
import {Location} from '@angular/common';
import {ActivatedRoute} from "@angular/router";
import {MatSnackBar} from "@angular/material/snack-bar";
import {TutorsService} from "../../services/tutors.service";
import {NonNullableFormBuilder, Validators} from "@angular/forms";

@Component({
  selector: 'app-tutor-form',
  templateUrl: './tutor-form.component.html',
  styleUrls: ['./tutor-form.component.scss']
})
export class TutorFormComponent implements OnInit {
  form = this.formBuilder.group({
    id: [''],
    name: ['', [Validators.required, Validators.minLength(5), Validators.maxLength(100)]],
    email: ['', [Validators.required, Validators.email]],
    cpf: ['', [Validators.required, Validators.minLength(14), Validators.maxLength(14)]]
  });

  constructor(private formBuilder: NonNullableFormBuilder,
              private service: TutorsService,
              private snackBar: MatSnackBar,
              private location: Location,
              private route: ActivatedRoute) {
  }

  ngOnInit(): void {
    const tutor: Tutor = this.route.snapshot.data['tutor'];
    this.form.setValue({
      id: tutor.id,
      name: tutor.name,
      cpf: tutor.cpf,
      email: tutor.email
    });
  }

  onSubmit() {
    this.service.save(this.form.value).subscribe(result => this.onSuccess(), error => this.onError());
  }

  onCancel() {
    this.location.back();
  }

  private onSuccess() {
    this.snackBar.open('Responsável salvo com sucesso.', '', {duration: 5000});
    this.location.back();
  }

  private onError() {
    this.snackBar.open('Erro ao salvar responsável.', '', {duration: 5000});
  }
}
