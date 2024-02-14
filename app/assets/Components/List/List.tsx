import ListItem from "./ListItem";
import {RequestData} from "../../Server/RequestAdvertisementsInterface";

export interface ListClickProps {
    onClick: (id: number, action?: string) => void;
}

interface ListProps extends ListClickProps{
    items: RequestData[];
}

export default function List({items, onClick}: ListProps) {
    if(!items) {
        return;
    }

    return (
        <ul className="list-unstyled">
            {items.map((item: RequestData) => <ListItem
                key={item.id}
                onClick={onClick}
                item={item}/>
            )}
        </ul>
    );
}