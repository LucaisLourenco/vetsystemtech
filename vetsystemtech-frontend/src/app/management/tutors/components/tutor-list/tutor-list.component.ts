import {Component, EventEmitter, Input, Output} from '@angular/core';
import {Tutor} from "../../model/tutor";
import {FormatData} from "../../../utils/format-data";
import {SelectionModel} from "@angular/cdk/collections";

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

  constructor(public formatData: FormatData) {
  }

  readonly displayedColumns = ['select', 'name', 'email', 'cpf', 'actions'];

  // No seu componente
  selection = new SelectionModel<any>(true, []);

  masterToggle() {
    this.isAllSelected() ?
      this.selection.clear() :
      this.tutors.forEach(row => this.selection.select(row));
  }

  isAllSelected() {
    const numSelected = this.selection.selected.length;
    const numRows = this.tutors.length;
    return numSelected === numRows;
  }

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
