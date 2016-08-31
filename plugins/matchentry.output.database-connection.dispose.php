<?php

						// DISCONNECT FROM DATABASE
						if ($DATABASE_ADAPTER)
						{
							if ($DATABASE_ADAPTER->database->connected)
							{
								$DATABASE_ADAPTER->database->disconnect();
							}
						}
						
?>