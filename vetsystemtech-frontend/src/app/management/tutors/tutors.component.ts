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
import {TutorLabelsEnum} from "../shared/enums/tutor-labels.enum";
import {TutorMessages} from "../shared/messages/tutor-messages";
import {CREATE, EDIT} from "./utils/tutors-routes";
import {PaginationService} from "ngx-pagination";
import {PaginationBaseComponent} from "../../core/base/pagination-base/pagination-base/pagination-base.component";

@Component({
  selector: 'app-tutors',
  templateUrl: './tutors.component.html',
  styleUrls: ['./tutors.component.scss']
})
export class TutorsComponent extends PaginationBaseComponent<any> {
  constructor(
    private tutorsService: TutorsService,
    public dialog: MatDialog,
    private router: Router,
    private route: ActivatedRoute,
    private snackBar: MatSnackBar
  ) {
    super(tutorsService);
  }

  onError(errorMsg: string) {
    this.dialog.open(ErrorDialogComponent, {
      data: errorMsg
    });
  }

  onAdd() {
    this.router.navigate([CREATE], {relativeTo: this.route}).then(r => true);
  }

  onEdit(tutor: Tutor) {
    this.router.navigate([EDIT, tutor.id], {relativeTo: this.route}).then(r => true);
  }

  onDelete(tutor: Tutor) {

    const dialogRef = this.dialog.open(ConfirmationDialogComponent, {
      data: TutorLabelsEnum.ROTULO_PERGUNTA_REMOVER_TUTOR,
    });

    dialogRef.afterClosed().subscribe((result: boolean) => {
      if (result) {
        this.tutorsService.delete(tutor.cpf).subscribe(
          () => {
            this.loadItems(1);
            this.snackBar.open(TutorMessages.TUR0001, 'x', {
              duration: 5000,
              verticalPosition: 'top',
              horizontalPosition: 'center'
            });
          },
          error => this.onError(TutorMessages.TUR0002)
        )
      }
    });
  }
}
