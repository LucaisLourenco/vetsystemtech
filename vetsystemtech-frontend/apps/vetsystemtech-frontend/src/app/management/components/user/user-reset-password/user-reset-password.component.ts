import { Component } from '@angular/core';
import { NonNullableFormBuilder, Validators } from '@angular/forms';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';
import { AuthUserService } from 'src/app/management/services/user/auth/auth-user.service';

@Component({
  selector: 'app-user-reset-password',
  templateUrl: './user-reset-password.component.html',
  styleUrls: ['./user-reset-password.component.scss'],
})
export class UserResetPasswordComponent {
  public errorMessage: string | null = null;

  constructor(
    private snackBar: MatSnackBar,
    private formBuilder: NonNullableFormBuilder,
    private service: AuthUserService,
    private router: Router
  ) {}

  form = this.formBuilder.group({
    email: ['', Validators.required],
  });

  onSubmit() {}

  onCancel() {
    this.router.navigate(['login']);
  }

  private onError(errorMessage: string) {
    this.snackBar.open(errorMessage, '', { duration: 5000 });
  }
}
