import {Component, EventEmitter, Input, Output} from '@angular/core';
import {Tutor} from "../../model/tutor";
import {FormatData} from "../../../utils/format-data";
import {ListBaseComponent} from "../../../../core/base/list-base/list-base.component";

@Component({
  selector: 'app-tutor-list',
  templateUrl: './tutor-list.component.html',
  styleUrls: ['./tutor-list.component.scss']
})
export class TutorListComponent extends ListBaseComponent<any> {
  @Input() tutors: Tutor[] = [];
  @Output() add = new EventEmitter(false);
  @Output() edit = new EventEmitter(false);
  @Output() delete = new EventEmitter(false);

  constructor(public formatData: FormatData) {
    super();
  }

  readonly displayedColumns = ['select', 'name', 'email', 'cpf', 'actions'];

  onAdd() {
    this.add.emit(true);
  }

  onEdit(tutor: Tutor) {
    this.edit.emit(tutor);
  }

  onDelete(tutor: Tutor) {
    this.delete.emit(tutor);
  }

  get data(): Tutor[] {
    return this.tutors;
  }

  get data_export(): any[] {
    return ['name', 'email', 'cpf'];
  }
}
