import {Component, EventEmitter, Input, Output} from '@angular/core';
import {Tutor} from "../../model/tutor";

@Component({
  selector: 'app-tutor-list',
  templateUrl: './tutor-list.component.html',
  styleUrls: ['./tutor-list.component.scss']
})
export class TutorListComponent {

  @Input() tutors: Tutor[] = [];
  @Output() add = new EventEmitter(false);
  @Output() edit = new EventEmitter(false);
  @Output() delete = new EventEmitter(false);

  readonly displayedColumns = ['nome', 'email', 'cpf', 'actions'];

  onAdd() {
    this.add.emit(true);
  }

  onEdit(tutor: Tutor) {
    this.edit.emit(tutor);
  }

  onDelete(tutor: Tutor) {
    this.delete.emit(tutor);
  }
}
