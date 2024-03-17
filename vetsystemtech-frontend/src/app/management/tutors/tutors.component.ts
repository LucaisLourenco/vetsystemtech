import {Component} from '@angular/core';
import {TutorsService} from "./services/tutors.service";
import {MatDialog} from "@angular/material/dialog";
import {ActivatedRoute, Router} from "@angular/router";
import {MatSnackBar} from "@angular/material/snack-bar";
import {catchError} from "rxjs/operators";
import {Observable, of} from "rxjs";
import {ErrorDialogComponent} from "../../shared/components/error-dialog/error-dialog.component";
import {Tutor} from "./model/tutor";
import {ConfirmationDialogComponent} from "../../shared/components/confirmation-dialog/confirmation-dialog.component";

@Component({
  selector: 'app-tutors',
  templateUrl: './tutors.component.html',
  styleUrls: ['./tutors.component.scss']
})
export class TutorsComponent {
  constructor(
    private tutorsService: TutorsService,
    public dialog: MatDialog,
    private router: Router,
    private route: ActivatedRoute,
    private snackBar: MatSnackBar
  ) {
    this.refresh();
  }

  tutors$: Observable<Tutor[]> | null = null;

  refresh() {
    console.log(this.tutorsService.list())
    this.tutors$ = this.tutorsService.list().pipe(
      catchError(error => {
        this.onError("Ouve um erro ao carregar os dados.");

        console.log(error);
        return of([]);
      })
    );
  }

  onError(errorMsg: string) {
    this.dialog.open(ErrorDialogComponent, {
      data: errorMsg
    });
  }

  onAdd() {
    this.router.navigate(['create'], {relativeTo: this.route}).then(r => true);
  }

  onEdit(tutor: Tutor) {
    this.router.navigate(['edit', tutor.id], {relativeTo: this.route}).then(r => true);
  }

  onDelete(tutor: Tutor) {

    const dialogRef = this.dialog.open(ConfirmationDialogComponent, {
      data: 'Deseja remover este responsável?',
    });

    dialogRef.afterClosed().subscribe((result: boolean) => {
      if (result) {
        this.tutorsService.delete(tutor.id).subscribe(
          () => {
            this.refresh();
            this.snackBar.open('Resposável removido com sucesso.', 'x', {
              duration: 5000,
              verticalPosition: 'top',
              horizontalPosition: 'center'
            });
          },
          error => this.onError('Ouve um erro ao remover o responsável.')
        )
      }
    });
  }
}
